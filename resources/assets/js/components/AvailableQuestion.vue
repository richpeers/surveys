<template>
    <div class="question">
        <div class="q-head">
            <div class="q-title">
                {{type}}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                required: true
            }
        }
    }
</script>