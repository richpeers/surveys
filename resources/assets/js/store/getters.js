// survey
export const getTitle = (state) => state.title;

export const getSurveyId = (state) => state.id;

//new survey questions
export const getNewSurveyQuestions = (state) => state.NewSurveyQuestions;

// questions
export const getAvailableQuestions = (state) => state.AvailableQuestions;

export const getQuestions = (state) => state.Questions;

export const getQuestion = (state) => (index) => state.Questions[index];

// question type params
export const getQuestionTypeParams = (state) => state.QuestionTypeParams;

// answer options
export const getAnswerOptions = (state) => (index) => state.Questions[index].options;

export const getAnswerOption = (getters) => (questionIndex, index) => getters(questionIndex)[index];
