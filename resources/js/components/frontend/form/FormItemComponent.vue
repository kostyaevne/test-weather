<template>
    <div class="form-group row">
        <div class="col-10">
            <div class="mb-2">
                <label :for="field_name">Name</label>
                <input v-model="form_item.name" @blur="validate_fields" :name="field_name" type="text" :id="field_name" class="form-control" maxlength="60">
            </div>
            <div>
                <label :for="field_phone">Phone</label>
                <input v-model="form_item.phone" @blur="validate_phone" :name="field_phone" type="text" :id="field_phone" :class="['form-control', { 'is-invalid' : !error_phone }]" maxlength="18">
                <div v-if="!error_phone" class="invalid-feedback">
                    Please provide a valid phone.
                </div>
            </div>
        </div>
        <div class="col-2">
            <a href="#" @click.prevent="remove_row(index)" role="button" class="d-table ml-auto text-danger"><i class="fas fa-times"></i></a>
        </div>
    </div>
    <add-row
</template>

<script>
    import Event from '../../../event.js';

    export default {
        name: "FormItemComponent",
        props: ['form_item', 'index'],
        data(){
            return {
                error_phone: true,
            }
        },
        computed: {
            field_name: function () { return `clients[${this.index}][name]` } ,
            field_phone: function () { return `clients[${this.index}][phone]` },
        },
        methods: {
            remove_row: function (index) {
                Event.$emit('remove_row', index);
                Event.$emit('remove_phone_error', index);
            },
            validate_fields: function () {
                if(this.form_item.phone && this.form_item.phone.length){
                    this.validate_phone();
                }
            },
            validate_phone: function () {
                if(this.form_item.phone && this.form_item.phone.length > 0) {
                    var regionCode = PhoneNumber(this.form_item.phone).getRegionCode();
                    var pn = new PhoneNumber(this.form_item.phone, regionCode);

                    this.error_phone = pn.isValid();

                    Event.$emit('phone_errors', [this.index, this.error_phone]);
                }
            }
        }
    }
</script>

<style scoped>

</style>