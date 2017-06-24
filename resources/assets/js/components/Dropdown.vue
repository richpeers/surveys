<template>
    <div class="dropdown">
        <div role="button"
             @click="isOpen = !isOpen"
             ref="toggle"
             class="toggle">
            <slot name="toggle"></slot>
        </div>

        <div v-if="isOpen"
             key="bg"
             class="background is-hidden-desktop">
        </div>

        <div v-show="isOpen"
             :class="['menu', position]">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            position: {
                type: String,
                default: 'is-bottom-right',
                validator(value) {
                    return [
                            'is-top-right',
                            'is-top-left',
                            'is-bottom-right',
                            'is-bottom-left'
                        ].indexOf(value) > -1
                }
            }
        },
        data: () => ({
            isOpen: false
        }),
        methods: {
            close(event) {
                let toggle = this.$refs.toggle;
                if (toggle !== undefined && !toggle.contains(event.target)) {
                    this.isOpen = false;
                }
            }
        },
        created() {
            if (typeof window !== 'undefined') {
                document.addEventListener('click', this.close)
            }
        },
        beforeDestroy() {
            if (typeof window !== 'undefined') {
                document.removeEventListener('click', this.close)
            }
        }
    }
</script>