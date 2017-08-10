// populate create/edit form data
export const setSurvey = ({dispatch, commit, getters}) => {
    return typeof window.survey != 'undefined' ? dispatch('setSurveyForEdit') : dispatch('setSurveyForCreate');
};

export const setSurveyForEdit = ({commit}) => {
    commit('updateId', window.survey.id);

    commit('updateTitle', window.survey.title);

    for (let question of window.survey.questions) {
        question.showBody = false;
    }
    commit('updateQuestions', cloneDeep(window.survey.questions));
};

export const setSurveyForCreate = ({getters, commit}) => {
    commit('updateQuestions', cloneDeep(getters.getNewSurveyQuestions));
};

// questions
export const collapseAll = ({commit, state}) => {
    for (let [index,] of state.Questions.entries()) {
        commit('updateQuestionProperty', {index, property: 'showBody', value: false});
    }
};

export const expand = ({dispatch, commit}, index) => {
    return dispatch('collapseAll').then(() => {
        commit('updateQuestionProperty', {index, property: 'showBody', value: true});
    });
};

export const toggleBody = ({dispatch, getters}, index) => {
    let question = getters.getQuestion(index);
    return question.showBody ? dispatch('collapseAll') : dispatch('expand', index);
};

export const toggleCanComment = ({dispatch, getters}, questionIndex, index) => {
    let answerOption = getters.getAnswerOption(questionIndex, index);
    return answerOption.showBody ? commmit('collapseAll') : dispatch('expand', index);
};

export const cloneQuestion = ({dispatch, getters, commit}, index) => {
    let cloned = cloneDeep(getters.getQuestion([index]));
    return dispatch('collapseAll').then(() => {
        commit('cloneQuestion', {question: cloned, index: index + 1});
    });
};

// save survey
export const updateOrderValues = ({state, commit}) => {
    for (let [questionIndex,] of state.Questions.entries()) {
        commit('updateQuestionOrder', questionIndex);
        if ("options" in state.Questions[questionIndex]) {
            for (let [index,] of state.Questions[questionIndex].options.entries()) {
                commit('updateAnswerOrder', {questionIndex, index})
            }
        }

    }
};

export const saveSurvey = ({dispatch, getters, commit}) => {

    dispatch('updateOrderValues')

        .then(() => {
            if (getters.getSurveyId !== null) {
                return dispatch('updateSurvey');
            }
            return dispatch('saveNewSurvey');
        })
        .then((response) => {
            console.log(response.data);
            window.location = response.data.redirect;
        })
        .catch((error) => {
            console.log(error.response.data);
            // commit('updateValidation', {
            //     form: 'NewSurvey',
            //     errors: error.response.data,
            // })
        });
};

export const saveNewSurvey = ({getters}) => {
    return axios.post('/surveys/store', {
        title: getters.getTitle,
        questions: getters.getQuestions,
    })
};

export const updateSurvey = ({getters}) => {
    return axios.put('/surveys/' + getters.getSurveyId, {
        title: getters.getTitle,
        questions: getters.getQuestions,
    })
};
