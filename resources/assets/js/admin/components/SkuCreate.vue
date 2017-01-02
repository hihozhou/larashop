<template>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">sku创建</h3>
                    </div>
                    <form @keydown.enter.prevent="deleteCategory" class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-1 control-label">父级id</label>
                                <div class="col-sm-11">
                                    <input type="number" class="form-control" id="pid" placeholder="父级id"
                                           v-model="sku.pid">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">名称</label>
                                <div class="col-sm-11">
                                    <input type="text" class="form-control" id="name" placeholder="sku名称"
                                           v-model="sku.name">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button class="btn btn-flat btn-info pull-right" @click="create(sku)">保存</button>
                            <button class="btn btn-flat btn-danger" @click="cancel()">取消</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import { stack_bottomright, show_stack_success, show_stack_error } from '../Pnotice.js'

    export default {
        mounted(){
            this.fetchSku()
        },
        data () {
            return {
                sku: {pid: 0}
            }
        },
        methods: {
            fetchSku () {
                this.sku.pid = this.$route.query.pid;
//                this.$set('sku.pid',pid);
//                this.$http({url: '/api/categories/' + itemId, method: 'GET'}).then(function (response) {
//                    this.$set('category', response.data)
//                })
            },
            create (sku) {
                event.preventDefault();
                this.$http.post('/api/admin/skus/create', sku).then(function (response) {
                    show_stack_success('Sku saved', response);
//                    this.$router.push('/admin/skus');
                }, function (response) {
                    show_stack_error('Failed to save sku', response)
                })
            },
            deleteCategory (category) {
                event.preventDefault();
                let self = this;
                swal({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this category!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, keep it',
                }).then(function () {
                    self.$http.delete('/api/categories/' + category.hashid, category).then(function (response) {
                        self.$router.go('/categories')
                        swal(
                                'Deleted!',
                                'Your category has been deleted.',
                                'success'
                        );
                    }, function (response) {
                        show_stack_error('Failed to delete category', response)
                    })
                }, function (dismiss) {
                    // dismiss can be 'cancel', 'overlay', 'close', 'timer'
                    if (dismiss === 'cancel') {
                        swal(
                                'Cancelled',
                                'Your category is safe :)',
                                'error'
                        );
                    }
                });
            },
            cancel(){
                this.$router.push('/admin/skus');
//                this.$router.go(-1);
            }

        }
    }
</script>


<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    h1 {
        color: #42b983;
    }
</style>