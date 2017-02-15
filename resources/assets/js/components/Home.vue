<template>
    <div>
        <div class="jumbotron hero">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-6 col-md-pull-0 get-it">
                        <h1>Easy Insights.</h1>
                        <p>Put the power of Insights to work in your organization quickly by using Insights profile pictures.</p>
                        <p><a class="btn btn-primary btn-lg" role="button" href="/about">Learn More About Insights</a>
                           <a v-if="!email.length" class="btn btn-success btn-lg" role="button" href="/login">Get Started Now</a>
                           <a v-else class="btn btn-success btn-lg" role="button" href="/dashboard  ">Get Started Now</a>
                       </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="testimonials">
            <h2 class="text-center">It's like changing the world!</h2>
            <blockquote>
                <p>You've arrived here since you are aware of the power of Insights Discovery. It's about helping people understand themselves and others, and make a positive impact in everything they do.</p>
                <footer>Insights Discovery customer</footer>
            </blockquote>
        </div>
        <div class="features">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Insight Profile Pictures</h3>
                        <p>Having individuals Insights colors on their profile pictures helps to maximize the benefits of Insights Discovery by providing an instant reference to the person you are communicating with. </p>
                    </div>
                    <div class="col-md-6">
                        <div class="row icon-features">
                            <div class="col-xs-4 icon-feature"><i class="glyphicon glyphicon-envelope"></i>
                                <p>Email Messages</p>
                            </div>
                            <div class="col-xs-4 icon-feature"><i class="glyphicon glyphicon-user"></i>
                                <p>Internal Social Networks</p>
                            </div>
                            <div class="col-xs-4 icon-feature"><i class="glyphicon glyphicon-send"></i>
                                <p>Instant Messages</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        mounted:function(){
            if(email){
                var self=this;
                self.email=email;
            }

        },
        data:function(){
            return{
                email:'',
            }
        }
    }
</script>
