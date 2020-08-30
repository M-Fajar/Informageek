<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
					<div class="col-md-4">
						<div class="card">
							<div class="card-header">
								<a href="">
									<h4><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Message</h4>
								</a>
							</div>
							<div class="card-body">
								<room></room>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<chat></chat>
					</div>
				</div>
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
        	url: String
        },
        data() {
        	return {

        	}
        }
    }
</script>
