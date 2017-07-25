<template>
    <div class="question">

        <div class="q-head val" :class="{'is-danger': $v.$invalid}">
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
                    <li><a @click="cloneQuestion">Clone</a></li>
                    <li><a @click="remove">Remove</a></li>
                </ul>
            </dropdown>

        </div>

        <div class="q-body" v-show="showBody" :class="{expanded: showBody}">

            <div class="field">
                <span class="control">
                    <label :for="'title-' + index" class="label">{{titleLabel}}</label>
                    <textarea :id="'title-' + index" class="textarea val" v-model="title"
                              :class="{'is-danger': $v.title.$invalid}" rows="2" maxlength="140"></textarea>
                </span>
                <p class="help is-danger" v-if="!$v.title.required">This Field is required</p>

            </div>

            <div class="field">
                <p class="control">
                    <label :for="'description-' + index" class="label">Description</label>
                    <textarea :id="'description-' + index" class="textarea" v-model="description"></textarea>
                </p>
            </div>

            <answer-options v-if="isMultiAnswer"
                            :questionIndex="index"
                            :$v="$v.options"
            ></answer-options>

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

    export default {
        components: {
            AnswerOptions
        },
        props: {
            index: {type: Number, required: true},
            question: {type: Object, required: true},
            params: {type: Object, required: true},
            $v: {type: Object, required: true},
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

            cloneQuestion () {
                this.$store.dispatch('cloneQuestion', this.index);
            },
            remove () {
                this.$store.commit('removeQuestion', this.index);
            }
        }
    }
</script>
