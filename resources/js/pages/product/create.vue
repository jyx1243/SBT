<template>
    <div class="container">
        <div class="d-flex flex-row-reverse">
            <!-- 側邊導覽 -->
            <div id="side-nav" class="p-3 mt-3 d-none d-lg-block" style="position: sticky; top: 4rem; min-width: 250px; height: calc(100vh - 10rem); overflow-y: auto;">
                <div class="nav flex-column nav-pills">
                    <router-link class="nav-link" to="#product">
                        <i class="bi bi-info-circle"></i> 基本資訊
                    </router-link>
                    <div v-for="(option, optionIndex) in form.options" :key="'option'+optionIndex">
                        <router-link class="nav-link" :to="'#option'+optionIndex">
                            <i class="bi bi-diagram-3"></i> 品項 {{ optionIndex+1 }}{{ option.name ? ' - '+option.name : '' }}
                        </router-link>
                        <router-link class="nav-link ml-3" :to="'#option'+optionIndex+'-price'">
                            <i class="bi bi-tag"></i> 價格 ( {{ option.prices.length }} )
                        </router-link>
                        <router-link class="nav-link ml-3" :to="'#option'+optionIndex+'-location'">
                            <i class="bi bi-box-seam"></i> 位置 ( {{ option.locations.length }} )
                        </router-link>
                    </div>
                </div>
            </div>

            <form @submit.prevent="postOption" class="flex-fill">
                <!-- 新增失敗 -->
                <div v-if="errors" class="rounded bg-ly shadow-sm mt-3 p-3">
                    <h4 class="my-3 text-danger">
                        <i class="bi bi-x-circle mx-2"></i>新增失敗
                    </h4>
                    <div v-for="(errorGroups, errorGroupIndex) in errors" :key="errorGroupIndex">
                        <h6 v-for="(error, errorIndex) in errorGroups" :key="errorIndex">{{ error }}</h6>
                    </div>
                </div>

                <!-- 表單內容 -->
                <div class="rounded bg-white shadow-sm mt-3 p-3">
                    <h2 class="my-4 text-center">新增商品</h2>
                    <h4 id="product" class="mb-3">
                        <i class="bi bi-info-circle mx-2"></i>基本資訊
                    </h4>
                    <div class="form-row">
                        <!-- 名稱 -->
                        <form-group class="col-md-8" id="name" title="名稱" :errors="getError('product.name')" required>
                            <template #default="{ id, title, required, hasError }">
                                <base-input type="text" v-model.trim="form.product.name" :maxlength="10" append 
                                :id="id" :title="title" :required="required" :hasError="hasError"></base-input>
                            </template>
                        </form-group>
                        <!-- 類型 -->
                        <form-group class="col-md-4" id="category" title="類型" :errors="getError('product.category')" required>
                            <template #default="{ id, title, required, hasError }">
                                <base-select v-model="form.product.category" :options="categorys" 
                                :id="id" :title="title" :required="required" :hasError="hasError"></base-select>
                            </template>
                        </form-group>
                    </div>
                    <!-- 別名 -->
                    <form-group id="subname" title="別名" :errors="getError('product.subname')">
                        <template #default="{ id, title, required, hasError }">
                            <base-input type="text" v-model.trim="form.product.subname" :maxlength="40" append
                            :id="id" :title="title" :required="required" :hasError="hasError"></base-input>
                        </template>
                        <template #help>輸入所有可能的別名、諧音，以便更容易搜尋該商品。</template>
                    </form-group>
                </div>

                <!-- 品項 -->
                <transition-group name="list-flip" tag="div" class="position-relative">
                    <div v-for="(option, optionIndex) in form.options" :key="'option'+optionIndex" class="rounded bg-white shadow-sm mt-3 p-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 :id="'option'+optionIndex" class="mb-0">
                                <i class="bi bi-diagram-3 mx-2"></i> 品項 {{ optionIndex+1 }}
                                <span class="h6" v-if="option.name"> / {{ option.name }}</span>
                            </h4>
                            <button-cancel @cancel="removeOption(optionIndex)" v-show="form.options.length > 1">刪除</button-cancel>
                        </div>

                        <div class="d-flex flex-column flex-md-row-reverse mt-3">
                            <div class="flex-fill">
                                <!-- 品項名稱 -->
                                <form-group id="optionName" title="品項名稱" :errors="getError('options.'+optionIndex+'.name')">
                                    <template #default="{ id, title, required, hasError }">
                                        <base-input type="text" v-model.trim="option.name" :maxlength="10" append 
                                        :id="id" :title="title" :required="required" :hasError="hasError"></base-input>
                                    </template>
                                    <template #help>輸入品項名稱以便區分各品項。</template>
                                </form-group>
                                <!-- 圖片 -->
                                <form-group id="image" title="圖片" :errors="getError('options.'+optionIndex+'.image')">
                                    <template #default="{ id, hasError }">
                                        <div class="custom-file">
                                            <input type="file" accept="image/*" :id="id" class="custom-file-input" :class="{ 'is-invalid': hasError }" @change="uploadImage(optionIndex, $event)">
                                            <label class="custom-file-label" :for="id" data-browse="瀏覽">{{ option.image ? option.image.name : "選擇圖片檔案" }}</label>
                                        </div>
                                    </template>
                                    <template #help>上傳代表此品項的圖片，僅可選擇一張。</template>
                                </form-group>
                            </div>
                            <!-- 圖片預覽 -->
                            <div class="px-0 mr-md-3 col-md-4 col-lg-3" v-if="previewImage[optionIndex]">
                                <img class="img-fluid" :src="previewImage[optionIndex]">
                            </div>
                        </div>

                        <h4 class="mb-0 border-top pt-4 mt-4">
                            <i class="bi bi-tag mx-2"></i>價格
                        </h4>
                        <transition-group name="list-flip" tag="div" class="position-relative">
                            <base-card v-for="(price, priceIndex) in option.prices" :key="'price'+price.id">
                                <template #title>
                                    <h6 class="mb-0" :class="{ 'text-info': option.default_price === priceIndex }">價格 {{ priceIndex+1 }}</h6>
                                    <div>
                                        <button @click.prevent="option.default_price = priceIndex" :disabled="option.default_price === priceIndex" class="btn btn-link px-0">
                                            設為主要
                                        </button>
                                        <button-cancel @cancel="removePrice(optionIndex, priceIndex)">刪除</button-cancel>
                                    </div>
                                </template>
                                <template #content>
                                    <!-- 價格 -->
                                    <form-group class="col-6 col-sm-8" id="value" title="價格" :errors="getError('options.'+optionIndex+'.prices.'+priceIndex+'.value')" required>
                                        <template #default="{ id, title, required, hasError }">
                                            <base-input type="number" v-model.trim="price.value" :min="0" prepend="$"
                                            :id="id" :title="title" :required="required" :hasError="hasError"></base-input>
                                        </template>
                                    </form-group>
                                    <!-- 單位 -->
                                    <form-group class="col-6 col-sm-4" id="unit" title="單位" :errors="getError('options.'+optionIndex+'.prices.'+priceIndex+'.unit')" required>
                                        <template #default="{ id, title, required, hasError }">
                                            <base-select v-model="price.unit" :options="units" :disableds="option.prices.map(function(i) { return Number(i.unit) } )"
                                            :id="id" :title="title" :required="required" :hasError="hasError"></base-select>
                                        </template>
                                    </form-group>
                                </template>
                            </base-card>
                        </transition-group>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <h6 class="mb-0">
                                <i class="bi bi-tag"></i> 價格項目總計 {{ option.prices.length }}
                            </h6>
                            <button-plus @plus="addPrice(optionIndex)">新增價格</button-plus>
                        </div>

                        <h4 class="mb-0 border-top pt-4 mt-4">
                            <i class="bi bi-box-seam mx-2"></i>位置
                        </h4>
                        <transition-group name="list-flip" tag="div" class="position-relative">
                            <base-card v-for="(location, locationIndex) in option.locations" :key="'location'+location.id">
                                <template #title>
                                    <h6 class="mb-0" :class="{ 'text-info': option.default_location === locationIndex }">位置 {{ locationIndex+1 }}</h6>
                                    <div>
                                        <button @click.prevent="option.default_location = locationIndex" :disabled="option.default_location === locationIndex" class="btn btn-link px-0">
                                            設為主要
                                        </button>
                                        <button-cancel @cancel="removeLocation(optionIndex, locationIndex)">刪除</button-cancel>
                                    </div>
                                </template>
                                <template #content>
                                    <!-- 區域 -->
                                    <form-group class="col-6 col-md-3" id="zone" title="區域" :errors="getError('options.'+optionIndex+'.locations.'+locationIndex+'.zone')" required>
                                        <template #default="{ id, title, required, hasError }">
                                            <base-select v-model="location.zone" :options="zones" 
                                            :id="id" :title="title" :required="required" :hasError="hasError"></base-select>
                                        </template>
                                    </form-group>
                                    <!-- 層 -->
                                    <form-group class="col-6 col-md-3" id="layer" title="層" :errors="getError('options.'+optionIndex+'.locations.'+locationIndex+'.layer')">
                                        <template #default="{ id, title, required, hasError }">
                                            <base-select v-model="location.layer" :options="layers" 
                                            :id="id" :title="title" :required="required" :hasError="hasError"></base-select>
                                        </template>
                                    </form-group>
                                    <!-- 欄 -->
                                    <form-group class="col-6 col-md-3" id="col" title="欄" :errors="getError('options.'+optionIndex+'.locations.'+locationIndex+'.col')">
                                        <template #default="{ id, title, required, hasError }">
                                            <base-input type="number" v-model.trim="location.col" :max="100" :min="0" prepend :placeholder="title"
                                            :id="id" :title="title" :required="required" :hasError="hasError">
                                                <template #prepend><i class="bi bi-arrow-right-circle"></i></template>
                                            </base-input>
                                        </template>
                                    </form-group>
                                    <!-- 列 -->
                                    <form-group class="col-6 col-md-3" id="row" title="列" :errors="getError('options.'+optionIndex+'.locations.'+locationIndex+'.row')">
                                        <template #default="{ id, title, required, hasError }">
                                            <base-input type="number" v-model.trim="location.row" :max="100" :min="0" prepend :placeholder="title"
                                            :id="id" :title="title" :required="required" :hasError="hasError">
                                                <template #prepend><i class="bi bi-arrow-down-circle"></i></template>
                                            </base-input>
                                        </template>
                                    </form-group>
                                </template>
                            </base-card>
                        </transition-group>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <h6 class="mb-0">
                                <i class="bi bi-box-seam"></i> 位置項目總計 {{ option.prices.length }}
                            </h6>
                            <button-plus @plus="addLocation(optionIndex)">新增位置</button-plus>
                        </div>
                    </div>
                </transition-group>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <h6 class="mb-0">
                        <i class="bi bi-diagram-3"></i> 品項項目總計 {{ form.options.length }}
                    </h6>
                    <button-plus @plus="addOption">新增品項</button-plus>
                </div>

                <div class="d-flex justify-content-end align-items-center border-top py-2 mx-n1 mt-2" style="position: sticky; bottom: 0; background: #faf9f8e0; z-index: 1020;">
                    <button @click.prevent="routerBack" class="btn btn-secondary mx-1 col col-sm-auto">
                        <i class="bi bi-arrow-return-left mr-2"></i>取消並返回
                    </button>
                    <button type="submit" class="btn btn-primary mx-1 col col-sm-auto">
                        <i class="bi bi-check2 mr-2"></i>確定新增商品
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import jsonToFormData from '../../jsonToFormData.js';
import FormGroup from '../../components/form/FormGroup.vue';
import BaseInput from '../../components/form/BaseInput.vue';
import BaseSelect from '../../components/form/BaseSelect.vue';
import BaseCard from '../../components/form/BaseCard.vue';
import ButtonCancel from '../../components/ButtonCancel.vue';
import ButtonPlus from '../../components/ButtonPlus.vue';

export default {
    components: {
        FormGroup,
        BaseInput,
        BaseSelect,
        BaseCard,
        ButtonCancel,
        ButtonPlus
    },
    data() {
        return {
            categorys: null,
            units: null,
            zones: null,
            layers: [
                { id: '上', name: '上層'},
                { id: '中', name: '中層'},
                { id: '下', name: '下層'}
            ],
            errors: null,
            previewImage: [],
            form: {
                product: {
                    name: '',
                    category: '',
                    subname: ''
                },
                options: [{
                    id: 0,
                    name: '',
                    image: null,
                    prices: [{
                        id: 0,
                        unit: '',
                        value: ''
                    }],
                    next_price_id: 1,
                    default_price: 0,
                    locations: [{
                        id: 0,
                        zone: '',
                        layer: '',
                        col: '',
                        row: ''
                    }],
                    next_location_id: 1,
                    default_location: 0,
                    ingredient: {}
                }],
                next_option_id: 1
            },
        }
    },
    created() {
        axios.get('/api/category')
        .then(response => {
            this.categorys = response.data
        })
        axios.get('/api/unit')
        .then(response => {
            this.units = response.data
        })
        axios.get('/api/zone')
        .then(response => {
            this.zones = response.data
        })
    },
    methods: {
        uploadImage(optionIndex, event) {
            this.form.options[optionIndex].image = event.target.files[0]
            const reader = new FileReader()
            reader.readAsDataURL(this.form.options[optionIndex].image)
            reader.onload = e => {
                this.previewImage.splice(optionIndex, 1, e.target.result)
            }
        },
        addOption() {
            this.previewImage.push(null)
            this.form.options.push({
                id: this.form.next_option_id++,
                name: '',
                image: null,
                prices: [{
                    unit: '',
                    value: ''
                }],
                default_price: 0,
                locations: [{
                    zone: '',
                    layer: '',
                    col: '',
                    row: ''
                }],
                default_location: 0,
                ingredient: {}
            })
        },
        addPrice(optionIndex) {
            this.form.options[optionIndex].prices.push({
                id: this.form.options[optionIndex].next_price_id++,
                unit: '',
                value: ''
            })
        },
        addLocation(optionIndex) {
            this.form.options[optionIndex].locations.push({
                id: this.form.options[optionIndex].next_location_id++,
                zone: '',
                layer: '',
                col: '',
                row: ''
            })
        },
        removeOption(optionIndex) {
            this.previewImage.splice(optionIndex, 1)
            this.form.options.splice(optionIndex, 1)
        },
        removePrice(optionIndex, priceIndex) {
            this.form.options[optionIndex].prices.splice(priceIndex, 1)
            if (this.form.options[optionIndex].default_price === priceIndex){
                this.form.options[optionIndex].default_price = ''
            } else if (this.form.options[optionIndex].default_price > priceIndex){
                this.form.options[optionIndex].default_price -= 1
            }
        },
        removeLocation(optionIndex, locationIndex) {
            this.form.options[optionIndex].locations.splice(locationIndex, 1)
            if (this.form.options[optionIndex].default_location === locationIndex){
                this.form.options[optionIndex].default_location = ''
            } else if (this.form.options[optionIndex].default_location > locationIndex){
                this.form.options[optionIndex].default_location -= 1
            }
        },
        routerBack() {
            window.history.length > 1 ? this.$router.go(-1) : this.$router.push('/')
        },
        postOption() {
            axios.post('/api/product', jsonToFormData.getFormData(this.form))
            .then(response => {
                this.$router.push({ name: 'product.show', params: { optionId: response.data }})
            })
            .catch(error => { 
                this.errors = error.response.data.errors
                this.backTop()
            })
        },
        backTop() {
            var timer = setInterval(function() {
                let osTop = document.documentElement.scrollTop || document.body.scrollTop
                let ispeed = Math.floor(-osTop / 5)
                document.documentElement.scrollTop = document.body.scrollTop = osTop + ispeed
                this.isTop = true
                if (osTop === 0){
                    clearInterval(timer);
                }
            }, 30)
        },
        getError(index) {
            if (this.errors && this.errors.hasOwnProperty(index)) {
                return this.errors[index]
            } else {
                return null
            }
        }
    }
}
</script>