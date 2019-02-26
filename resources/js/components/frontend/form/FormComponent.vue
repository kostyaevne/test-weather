<template>
    <div class="container-fluid">
        <form-item-component v-for="(item, index) in form_items" :key="index" :index="index" :form_item="item"></form-item-component>
    </div>
</template>

<script>
    import Event from '../../../event.js';
    import FormItemComponent from "./FormItemComponent";

    export default {
        name: "FormComponent",
        components: {FormItemComponent},
        data(){
            return {
                form_items: AppConfiguration.clients,
                errors: AppConfiguration.errors,
            }
        },
        mounted() {
            let form_component = this;

            Event.$on('add_row', (item_model) => {
                form_component.form_items.push(item_model);
            });

            Event.$on('remove_row', (index) => {
                form_component.form_items = form_component.filter_models(form_component.form_items, index);
            });
        },
        methods: {
            filter_models : (models_items, except_index) => {
                let form_items = [];

                for(let curr_index in models_items){
                    if(curr_index != except_index) {
                        form_items.push(models_items[curr_index]);
                    }
                }

                return form_items;
            }
        }
    }
</script>

<style scoped>

</style>