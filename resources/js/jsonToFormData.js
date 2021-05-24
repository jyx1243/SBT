let exports = {};

exports.buildFormData = (formData, data, parentKey) => {
    if (data && typeof data === 'object' && !(data instanceof Date) && !(data instanceof File)) {
        Object.keys(data).forEach(key => {
        exports.buildFormData(formData, data[key], parentKey ? `${parentKey}[${key}]` : key);
        });
    } else {
        const value = data == null ? '' : data;
        formData.append(parentKey, value);
    }
};

exports.getFormData = (data) => {
    const formData = new FormData();
    exports.buildFormData(formData, data);
    return formData;
};

export default exports;