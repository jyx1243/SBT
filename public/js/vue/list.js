let options = JSON.parse(document.getElementById('listViewModel').dataset.options);

let app = new Vue({
    el: '#listViewModel',
    data: {
        options: options,
    },
    computed: {
        optionsCount: function () {
            return this.options.length
        },
        // quantity: function () {
        //     return this.options.map( el => el.quantity )
        // },
    },
    methods: {
        modifyQuantity: function (index, n) {
            this.options[index]['quantity'] += n
            console.log(this.options)
        }
    }
});