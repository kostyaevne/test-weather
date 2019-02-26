<template>
    <div class="row">
        <div class="col-6">
            <button v-if="show_btn" type="submit" class="btn btn-primary" form="send_clients_data">Save form</button>
        </div>
        <div class="col-6">
            <a href="#" @click.prevent="add_row" class="btn btn-primary d-table ml-auto">Add row</a>
        </div>
    </div>
</template>

<script>
    import Event from '../../../event.js';

    export default {
        name: "AddRowComponent",
        data(){
            return {
                phone_errors: {},
                show_btn: false,
            }
        },
        mounted(){
            let add_component = this;
            add_component.show_btn = this.send_form();

            Event.$on('phone_errors', (error) => {
                console.log(error)
                add_component.phone_errors[error[0]] = error[1];
                add_component.show_btn = add_component.send_form();
            });

            Event.$on('remove_phone_error', (index) => {
                delete(add_component.phone_errors[index]);
                add_component.show_btn = add_component.send_form();
            });
        },
        methods: {
            add_row : () => {
                Event.$emit('add_row', {name: "", phone: ""});
            },
            send_form : function () {
                let length = 0;
                for(let key in this.phone_errors) {
                    if(!this.phone_errors[key]) {
                        return false;
                    }
                    length++;
                }

                return length > 0 ? true : false;
            }
        }
    }
</script>

<style scoped>

</style>