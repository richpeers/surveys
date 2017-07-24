// survey
export const updateTitle = (state, value) => {
  state.title = value;
};

// questions
export const updateQuestions = (state, value) => {
    state.NewSurveyQuestions = [...value];
};

export const removeQuestion = (state, index) => {
    state.NewSurveyQuestions.splice(index, 1);
};

export const cloneQuestion = (state, {question, index}) => {
    state.NewSurveyQuestions.splice(index, 0, question);
};

export const updateQuestionProperty = (state, {index, property, value}) => {
    state.NewSurveyQuestions[index][property] = value;
};

export const updateQuestionOrder = (state, index) => {
    state.NewSurveyQuestions[index].order = Number(index) + 1;
};

// answer options
export const updateAnswerOptions = (state, {index, value}) => {
    state.NewSurveyQuestions[index].options = [...value];
};

export const updateAnswerOptionProperty = (state, {questionIndex, index, property, value}) => {
    state.NewSurveyQuestions[questionIndex].options[index][property] = value;
};

export const removeAnswerOption = (state, {questionIndex, index}) => {
    state.NewSurveyQuestions[questionIndex].options.splice(index, 1);
};

export const addAnswerOption = (state, questionIndex) => {
    state.NewSurveyQuestions[questionIndex].options.push({
        answer: "",
        canComment: false,
    });
};

export const updateAnswerOrder = (state, {questionIndex, index}) => {
    state.NewSurveyQuestions[questionIndex].options[index].order = Number(index) + 1;
};

export const updateValidation = (state, {form, errors}) => {
    state.validation[form] = errors;
};