<template>
    <!-- item template -->
    <script type="text/x-template" id="item-template">
        <li>
            <div
                    :class="{bold: isFolder}"
                    @click="toggle"
                    @dblclick="changeType">
                {{model.name}}
                <span v-if="isFolder">[{{open ? '-' : '+'}}]</span>
            </div>
            <ul v-show="open" v-if="isFolder">
                <item
                        class="item"
                        v-for="model in model.children"
                        :model="model">
                </item>
                <li class="add" @click="addChild">+</li>
            </ul>
        </li>
    </script>

    <p>(You can double click on an item to turn it into a folder.)</p>

    <!-- the demo root element -->
    <ul id="demo">
        <item
                class="item"
                :model="treeData">
        </item>
    </ul>
</template>

<script>
    // demo data
    var data = {
        name: 'My Tree',
        children: [
            { name: 'hello' },
            { name: 'wat' },
            {
                name: 'child folder',
                children: [
                    {
                        name: 'child folder',
                        children: [
                            { name: 'hello' },
                            { name: 'wat' }
                        ]
                    },
                    { name: 'hello' },
                    { name: 'wat' },
                    {
                        name: 'child folder',
                        children: [
                            { name: 'hello' },
                            { name: 'wat' }
                        ]
                    }
                ]
            }
        ]
    }

    // define the item component
    Vue.component('item', {
        template: '#item-template',
        props: {
            model: Object
        },
        data: function () {
            return {
                open: false
            }
        },
        computed: {
            isFolder: function () {
                return this.model.children &&
                        this.model.children.length
            }
        },
        methods: {
            toggle: function () {
                if (this.isFolder) {
                    this.open = !this.open
                }
            },
            changeType: function () {
                if (!this.isFolder) {
                    Vue.set(this.model, 'children', [])
                    this.addChild()
                    this.open = true
                }
            },
            addChild: function () {
                this.model.children.push({
                    name: 'new stuff'
                })
            }
        }
    })

    // boot up the demo
    var demo = new Vue({
        el: '#demo',
        data: {
            treeData: data
        }
    })

</script>