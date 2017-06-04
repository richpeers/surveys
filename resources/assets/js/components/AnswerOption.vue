<template>
    <div class="field has-addons option">
        <p class="control o-handle">
            <a class="button is-static">
                <i class="fa fa-bars"></i>
            </a>
        </p>
        <p class="control is-expanded">
            <input class="input" :value="answer" placeholder="Answer Option">
        </p>
        <p class="control">
            <a class="button">
                <i class="fa fa-cog"></i>
            </a>
        </p>
    </div>
</template>

<script>
    export default {
        props: {
            answer: {
                type: String,
                required: true
            },
            canComment: {
                type: Boolean,
                required: true
            }
        }
    }
</script>