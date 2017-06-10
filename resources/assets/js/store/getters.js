// questions
export const getAvailableQuestions = (state) => state.AvailableQuestions;

export const getQuestions = (state) => state.NewSurveyQuestions;

export const getQuestion = (state) => (index) => state.NewSurveyQuestions[index];

// question type params
export const getQuestionTypeParams = (state) => state.QuestionTypeParams;

// answer options
export const getAnswerOptions = (state) => (index) => state.NewSurveyQuestions[index].options;

export const getAnswerOption = (getters) => (questionIndex, index) => getters(questionIndex)[index];
