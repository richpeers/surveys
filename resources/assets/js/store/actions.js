export const collapseAll = ({commit, state}) => {
    for (let [index,] of state.NewSurveyQuestions.entries()) {
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

export const updateOrderValues = ({state, commit}) => {
    for (let [questionIndex,] of state.NewSurveyQuestions.entries()) {
        commit('updateQuestionOrder', questionIndex);
        if ("options" in state.NewSurveyQuestions[questionIndex]) {
            for (let [index,] of state.NewSurveyQuestions[questionIndex].options.entries()) {
                commit('updateAnswerOrder', {questionIndex, index})
            }
        }

    }
};

export const saveNewSurvey = ({dispatch, commit}, payload) => {
    dispatch('updateOrderValues')
        .then(function () {
            axios.post('/surveys/store', payload)
                .then(function (response) {
                    console.log(response.data);
                    window.location = response.data.redirect;
                })
                .catch(function (error) {
                    console.log(error.response.data);
                    commit('updateValidation', {
                        form: 'NewSurvey',
                        errors: error.response.data,
                    })
                });
        });
};
