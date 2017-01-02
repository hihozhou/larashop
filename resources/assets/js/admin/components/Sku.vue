<template>
    <section class="content">
        <div>
            <h1>Sku管理</h1>
            <button type="button" @click="create" class="btn btn-lg btn-primary btn-flat">
                添加Sku
            </button>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Panel heading</div>

                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>名称</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <template v-for="(sku,index) in skuList">
                            <tr v-bind:index="index">
                                <td>{{sku.name}}</td>
                                <td>
                                    <div class="btn-group">
                                        <router-link :to="{ name: 'skusCreate', query: { pid: sku.id }}" tag="button" class="btn btn-success">添加子类</router-link>
                                        <router-link :to="{ name: 'skusEdit', params: { id: sku.id }}" tag="button" class="btn btn-warning">编辑</router-link>
                                        <button type="button"
                                                class="btn btn-danger" @click="skuDelete(index)">
                                            删除
                                        </button>
                                    </div>

                                </td>
                            </tr>
                            <template v-if="sku.childs.length != 0">
                                <template v-for="sku in sku.childs">
                                    <tr  v-bind:index="index">
                                        <td>|——{{sku.name}}</td>
                                        <!--<td>{{skuOne}}</td>-->
                                        <td>
                                            <div class="btn-group">
                                                <router-link :to="{ name: 'skusCreate', query: { pid: sku.id }}" tag="button" class="btn btn-success">添加子类</router-link>
                                                <router-link :to="{ name: 'skusEdit', params: { id: sku.id }}" tag="button" class="btn btn-warning">编辑</router-link>
                                                <button type="button"
                                                        class="btn btn-danger" @click="skuDelete(index)">
                                                    删除
                                                </button>
                                            </div>

                                        </td>
                                    </tr>
                                    <template v-if="sku.childs.length != 0">
                                        <tr v-for="sku in sku.childs" v-bind:index="index">
                                            <td>|————{{sku.name}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <!--<button type="button"-->
                                                            <!--class="btn btn-success">-->
                                                        <!--添加子类-->
                                                    <!--</button>-->
                                                    <router-link :to="{ name: 'skusEdit', params: { id: sku.id }}"
                                                                 tag="button" class="btn btn-warning">编辑
                                                    </router-link>
                                                    <button type="button"
                                                            class="btn btn-danger" @click="skuDelete(index)">
                                                        删除
                                                    </button>
                                                </div>

                                            </td>
                                        </tr>
                                    </template>
                                </template>
                            </template>

                        </template>
                        </tbody>

                    </table>


                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import { stack_bottomright, show_stack_success, show_stack_error, show_stack_info } from '../Pnotice.js'

    export default {
        mounted () {
            this.fetchSkuList()
        },
        data () {
            return {
                skuList: {}
            }
        },
        methods: {
            fetchSkuList () {
                this.$http({url: '/api/admin/skus', method: 'GET'}).then(function (response) {
                    console.log(response.data.data.list);
                    this.$set(this, 'skuList', response.data.data.list);
                });
            },
            create () {
                show_stack_info('Creating Category...');
                this.$router.push('/admin/skus/create');
//                this.$router.back();
//                this.$http({url: '/api/categories', method: 'POST'}).then(function (response) {

//                });
            },
            skuDelete (index) {
                let self = this;
                let sku = self.skuList[index];
                console.log(sku);
                swal({
                    title: '你确认码?',
                    text: '您将无法恢复此SKU!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '确认!',
                    cancelButtonText: '取消',
                }).then(function () {
                    self.skuList.splice(index, 1);
                    self.$http.delete('/api/admin/sku/' + sku.id, sku).then(function (response) {
                        swal(
                                'Deleted!',
                                'Your sku has been deleted.',
                                'success'
                        );
                    }, function (response) {
                        show_stack_error('Failed to delete sku', response)
                    })
                }, function (dismiss) {
                    // dismiss can be 'cancel', 'overlay', 'close', 'timer'
                    if (dismiss === 'cancel') {
                        swal(
                                'Cancelled',
                                'Your sku is safe :)',
                                'error'
                        );
                    }
                });
            },
        }
    }
</script>