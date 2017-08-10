// survey
export const updateId = (state, value) => {
    state.id = value;
};

export const updateTitle = (state, value) => {
  state.title = value;
};

// questions
export const updateQuestions = (state, value) => {
    state.Questions = [...value];
};

export const removeQuestion = (state, index) => {
    state.Questions.splice(index, 1);
};

export const cloneQuestion = (state, {question, index}) => {
    state.Questions.splice(index, 0, question);
};

export const updateQuestionProperty = (state, {index, property, value}) => {
    state.Questions[index][property] = value;
};

export const updateQuestionOrder = (state, index) => {
    state.Questions[index].order = Number(index) + 1;
};

// answer options
export const updateAnswerOptions = (state, {index, value}) => {
    state.Questions[index].options = [...value];
};

export const updateAnswerOptionProperty = (state, {questionIndex, index, property, value}) => {
    state.Questions[questionIndex].options[index][property] = value;
};

export const removeAnswerOption = (state, {questionIndex, index}) => {
    state.Questions[questionIndex].options.splice(index, 1);
};

export const addAnswerOption = (state, questionIndex) => {
    state.Questions[questionIndex].options.push({
        answer: "",
        canComment: false,
    });
};

export const updateAnswerOrder = (state, {questionIndex, index}) => {
    state.Questions[questionIndex].options[index].order = Number(index) + 1;
};
