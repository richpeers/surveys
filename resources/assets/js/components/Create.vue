<script>
    import {SurveyQuestions} from '../utils/sharedState.js';

    import Questions from './Questions.vue';

    export default {
        components: {
            Questions
        },
        data: () => ({
            SurveyQuestions
        })
    }
</script>
