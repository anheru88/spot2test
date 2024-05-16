<template>
    <div class="content" style="background-color: #f0f0f0; height: 100vh; display: flex; justify-content: center; align-items: center;">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <p style="font-size: 24px;">This page will redirect in {{ countdown }} seconds.</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        redirectUrl: String // URL passed from the controller
    },
    data() {
        return {
            countdown: 5
        };
    },
    mounted() {
        this.timer = setInterval(() => {
            if (this.countdown > 0) {
                this.countdown--;
            } else {
                clearInterval(this.timer);
                window.location.href = this.redirectUrl; // Redirect to the URL passed from controller
            }
        }, 1000);
    },
    beforeDestroy() {
        clearInterval(this.timer);
    }
};
</script>

<style scoped>
.content {
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    counter-reset: my-count 5;
    animation: countdown 5s linear infinite;
}

@keyframes countdown {
    0% {
        background: hsl(0,100%,20%);
    }
    20% {
        counter-increment: my-count -1;
        background: hsl(90,100%,20%);
    }
    40% {
        counter-increment: my-count -2;
        background: hsl(180,100%,20%);
    }
    60% {
        counter-increment: my-count -3;
        background: hsl(270,100%,20%);
    }
    80% {
        counter-increment: my-count -4;
        background: hsl(360,100%,20%);
    }
    100% {
        background: hsl(0,100%,20%);
    }
}
</style>
