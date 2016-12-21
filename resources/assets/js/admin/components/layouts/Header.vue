<template>
    <div >
        <navbar></navbar>
        <sidebar></sidebar>
    </div>
</template>


<script>
    import Navbar from './Navbar.vue'
    import Sidebar from './Sidebar.vue'



    export default {
        components: {
            Navbar,
            Sidebar
        },
        replace: false
    }
</script>