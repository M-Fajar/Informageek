<template>
            <div class="panel panel-default">
                <div class="panel-header">
                    <div class="row">
                        <div class="col-xs-1">
                            <a href="#"><img v-bind:src="'/media/user.jpg'" class="img-circle" alt="user image" width="50px"></a>
                        </div>
                        <div class="col-xs-10 align-middle">
                            <a href="#" class="h5">Nama User </a>
                        </div>
                        <div class="col-xs-1">
                            <a href="#"><span class="glyphicon glyphicon-exclamation-sign"></span></a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="panel-body" style="min-height: 20vh">
                    <ul class="message">
                        <li class="message-list">tes</li>
                        <li class="message-list message-own"> tes</li>
                    </ul>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Text message..." aria-describedby="send">
                        <span class="input-group-addon" id="send"><a href=""><span class="glyphicon glyphicon-send"></span> Send</a></span>
                    </div>
                </div>
            </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: {
            
        },

    }
</script>
