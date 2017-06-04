<template>
    <div class="question">

        <div class="q-head">
            <div class="q-handle"><i class="fa" v-bind:class="showBody ? params.icon + ' fa-lg' : 'fa-bars'"></i></div>
            <div class="q-title" v-on:click="toggleCollapse">
                <span v-if="showBody" class="q-left">{{params.type}}</span>
                <span v-else="showBody" class="q-left">{{title}}</span>
                <span class="q-right">
                    <i class="fa" v-bind:class="showBody ? 'fa-caret-up' : 'fa-caret-down'"></i>
                </span>
            </div>
            <div class="q-right" v-on:click="remove"><i class="fa fa-times"></i></div>
        </div>

        <div class="q-body" v-show="showBody" :class="{expanded: showBody}">
            <div class="field">
                <label class="label">{{params.titleLabel}}</label>
                <p class="control">
                    <input class="input" type="text"
                           :value="title"
                           v-on:input="$emit('update:title', $event.target.value)"/>
                </p>
            </div>
            <div class="field">
                <p class="control">
                    <label class="label">Description</label>
                    <textarea class="textarea"
                              :value="description"
                              v-on:input="$emit('update:description', $event.target.value)">
                    </textarea>
                </p>
            </div>

            <answer-options v-if="params.isMultiAnswer" :answer-options="answerOptions"></answer-options>

            <div v-if="params.canBeRequired" class="field">
                <p class="control">
                    <label class="checkbox">
                        <input type="checkbox"
                               :checked="required"
                               v-on:change="$emit('change:required', !required)"/>
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
            params: {
                type: Object,
                required: true
            },
            showBody: {
                type: Boolean,
                required: true
            },
            title: {
                type: String,
                required: true
            },
            description: {
                type: String,
                required: true
            },
            answerOptions: {
                type: Array,
                default () {
                    return [];
                }
            },
            required: {
                type: Boolean,
                required: true
            },
        },
        methods: {
            remove () {
                this.$emit('remove_question');
            },
            toggleCollapse () {
                this.$emit('toggle_collapse');
            }
        }
    }
</script>
