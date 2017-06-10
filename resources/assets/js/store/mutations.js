// questions
export const updateQuestions = (state, value) => {
    state.NewSurveyQuestions = [...value];
};

export const removeQuestion = (state, index) => {
    state.NewSurveyQuestions.splice(index, 1);
};

export const updateQuestionProperty = (state, {index, property, value}) => {
    state.NewSurveyQuestions[index][property] = value;
};

// answer options
export const updateAnswerOptions = (state, {index, value}) => {
    state.NewSurveyQuestions[index].options = [...value];
};

export const updateAnswerOptionProperty = (state, {questionIndex, index, property, value}) => {
    state.NewSurveyQuestions[questionIndex].options[index][property] = value;
};
