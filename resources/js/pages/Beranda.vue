<template>
    <div class="container-fluid">
        <div class="row">
                <!-- Sidebar Kanan -->
            <div class="col-md-3">
                <SidebarLeftHome/>
            </div>
            <!-- Beranda Tengah -->
            <div class="col-md-6 py-3">
                <CreatePostForm :avatar="avatar" />
                <Timeline :post-length="3" :show-form="true" />
            </div>
            <!-- Sidebar Kanan -->
            <div class="col-md-3">
                <SidebarRightHome/>
            </div>
        </div>
    </div>
</template>

<style scoped>
.container-fluid {
    overflow: hidden;
    margin: 0 !important;
    padding: 0 !important;
}
</style>

<script>
import SidebarLeftHome from '../components/SidebarLeftHome';
import SidebarRightHome from '../components/SidebarRightHome';
import PostPreview from '../components/PostPreview';
import Timeline from '../components/Timeline';
import CreatePostForm from '../components/form/CreatePostForm';
export default {
    components: {
        SidebarLeftHome,
        SidebarRightHome,
        PostPreview,
        Timeline,
        CreatePostForm
    },
    data() {
        return {
            avatar: "/media/frontend/sugiono.png"
        }
    }
}
</script>