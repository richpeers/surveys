<script>
    import Questions from './Questions.vue';

    export default {
        components: {Questions},
        data: () => ({}),
        methods: {},
        created() {
            this.$store.dispatch('setSurvey');
        }
    }
</script>
