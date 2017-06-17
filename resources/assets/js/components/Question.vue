<template>
    <div class="question">

        <div class="q-head">
            <div class="q-handle">
                <i class="fa" v-bind:class="showBody ? icon + ' fa-lg' : 'fa-bars'"></i>
            </div>
            <div class="q-title" v-on:click="toggleBody">
                <span v-if="showBody" class="q-left">{{type}}</span>
                <span v-else="showBody" class="q-left">{{title}}</span>
                <span class="q-right">
                    <i class="fa" v-bind:class="showBody ? 'fa-caret-up' : 'fa-caret-down'"></i>
                </span>
            </div>

            <dropdown>
                <div slot="toggle" class="q-right">
                    <i class="fa fa-cog"></i>
                </div>
                <ul class="menu-list">
                    <li><a @click="remove">Remove</a></li>
                    <li><a>option 2</a></li>
                    <li><a>option 3</a></li>
                </ul>
            </dropdown>

        </div>

        <div class="q-body" v-show="showBody" :class="{expanded: showBody}">

            <div class="field">
                <p class="control">
                    <label :for="'title-' + index" class="label">{{titleLabel}}</label>
                    <input :id="'title-' + index" class="input" type="text" v-model="title">
                </p>
            </div>

            <div class="field">
                <p class="control">
                    <label :for="'description-' + index" class="label">Description</label>
                    <textarea :id="'description-' + index" class="textarea" v-model="description"></textarea>
                </p>
            </div>

            <answer-options v-if="isMultiAnswer" :questionIndex="index"></answer-options>

            <div v-if="canBeRequired" class="field">
                <p class="control">
                    <label class="checkbox">
                        <input type="checkbox"
                               v-model="required">
                        Answer required
                    </label>
                </p>
            </div>

        </div>

    </div>
</template>

<script>
    import AnswerOptions from './AnswerOptions.vue';
    import BDropdown from "../../../../node_modules/buefy/src/components/dropdown/Dropdown";

    export default {
        components: {
            BDropdown,
            AnswerOptions
        },
        props: {
            index: {type: Number, required: true},
            question: {type: Object, required: true},
            params: {type: Object, required: true}
        },
        computed: {
            type () {
                return this.params.type;
            },
            showBody () {
                return this.question.showBody;
            },
            icon () {
                return this.params.icon
            },
            titleLabel () {
                return this.params.titleLabel;
            },
            isMultiAnswer () {
                return this.params.isMultiAnswer;
            },
            canBeRequired () {
                return this.params.canBeRequired;
            },
            title: {
                get() {
                    return this.question.title;
                },
                set(value) {
                    this.update('title', value);
                }
            },
            description: {
                get() {
                    return this.question.description;
                },
                set(value) {
                    this.update('description', value);
                }
            },
            options () {
                return this.question.options;
            },
            required: {
                get() {
                    return this.question.required;
                },
                set(value) {
                    this.update('required', value);
                }

            }
        },
        methods: {
            update (property, value) {
                this.$store.commit('updateQuestionProperty', {index: this.index, property, value});
            },
            toggleBody () {
                this.$store.dispatch('toggleBody', this.index);
            },
            runMethod (value) {
                this[value]();
            },
            remove () {
                this.$store.commit('removeQuestion', this.index);
            }
        }
    }
</script>
