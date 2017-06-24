<template>
    <div class="field has-addons option">

        <p class="control o-handle">
            <a class="button is-static">
                <i class="fa fa-bars"></i>
            </a>
        </p>

        <p class="control is-expanded has-icons-right">
            <input class="input" v-model="answer">
            <span v-if="canComment" class="icon is-small is-right">
                <i class="fa fa-comment-o"></i>
            </span>
        </p>

        <dropdown>
            <p slot="toggle" class="control">
                <a class="button is-static">
                    <i class="fa fa-cog"></i>
                </a>
            </p>
            <ul class="menu-list">
                <li @click="toggleCanComment"><a>{{textForToggleCanComment}}</a></li>
                <li><a @click="remove">Remove</a></li>
            </ul>
        </dropdown>

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
                return !!this.option.canComment;
            },
            textForToggleCanComment() {
                return this.canComment ? 'Turn comments off' : 'Turn Comments on'
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
            },
            remove () {
                this.$store.commit('removeAnswerOption', {
                    questionIndex: this.questionIndex,
                    index: this.index
                })
            }
        }
    }
</script>
