<template>
    <div class="field has-addons option">
        <p class="control o-handle">
            <a class="button is-static">
                <i class="fa fa-bars"></i>
            </a>
        </p>
        <p class="control is-expanded">
            <input class="input" v-model="answer" placeholder="Answer Option">
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
        name: 'answer-option',
        props: {
            index: {
                type: Number,
                required: true
            },
            questionIndex: {
                type: Number,
                required: true
            },
            option: {
                type: Object,
                required: true
            }
        },
        computed: {
            answer: {
                get() {
                    return this.option.answer;
                },
                set(value) {
                    this.update('answer', value);
                }
            },
            canComment() {
                return this.option.canComment;
            }
        },
        methods: {
            update (property, value) {
                this.$store.commit('updateAnswerOptionProperty', {
                    questionIndex: this.questionIndex,
                    index: this.index,
                    property,
                    value
                });
            },
            toggleCanComment () {
                this.update('canComment', !this.canComment);
            }
        }
    }
</script>