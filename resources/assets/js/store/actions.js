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
