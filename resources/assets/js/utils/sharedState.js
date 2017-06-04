export {AvailableQuestions, SurveyQuestions, QuestionTypeParams};

let QuestionTypeParams = {
    1: {
        type: "Welcome page",
        titleLabel: "Title",
        canBeRequired: false,
        icon: "fa-smile-o",
        isMultiAnswer: false,
        canHavePlaceholder: false
    },
    2: {
        type: "Radio buttons",
        titleLabel: "Question",
        canBeRequired: true,
        icon: "fa-dot-circle-o",
        isMultiAnswer: true,
        canHavePlaceholder: false
    },
    3: {
        type: "Checkboxes",
        titleLabel: "Question",
        canBeRequired: true,
        icon: "fa-check-square-o",
        isMultiAnswer: true,
        canHavePlaceholder: false
    },
    4: {
        type: "Dropdown list",
        titleLabel: "Question",
        canBeRequired: true,
        icon: "fa-caret-down",
        isMultiAnswer: true,
        canHavePlaceholder: false
    },
    5: {
        type: "Single line text",
        titleLabel: "Question",
        canBeRequired: true,
        icon: "fa-font",
        isMultiAnswer: false,
        canHavePlaceholder: true
    },
    6: {
        type: "Multiple line text",
        titleLabel: "Question",
        canBeRequired: true,
        icon: "fa-pencil-square-o",
        isMultiAnswer: false,
        canHavePlaceholder: true
    },
    7: {
        type: "Email address",
        titleLabel: "Question",
        canBeRequired: true,
        icon: "fa-at",
        isMultiAnswer: false,
        canHavePlaceholder: true
    },
    8: {
        type: "Rating",
        titleLabel: "Question",
        canBeRequired: true,
        icon: "fa-star-half-o",
        isMultiAnswer: false,
        canHavePlaceholder: true
    },
    9: {
        type: "Success page",
        titleLabel: "Title",
        canBeRequired: false,
        icon: "fa-trophy",
        isMultiAnswer: false,
        canHavePlaceholder: false
    },
};

let SurveyQuestions = [
    {
        type_id: 5,
        showBody: false,
        title: "What question do you want to ask?",
        description: "",
        required: false
    },
    {
        type_id: 9,
        showBody: false,
        title: "Thank you!",
        description: "Your feedback is very important to us.",
        required: false
    }
];

let AvailableQuestions = [
    {
        type_id: 1,
        showBody: false,
        title: "Tell us what you think!",
        description: "Please take a moment to fill out this short survey to let us know how we did and where we can improve.",
        required: false
    },
    {
        type_id: 2,
        showBody: false,
        title: "What question do you want to ask?",
        description: "",
        options: [{
            answer: "Answer 1",
            canComment: false
        }, {
            answer: "Answer 2",
            canComment: false
        }, {
            answer: "Other",
            canComment: true
        }],
        required: false
    },
    {
        type_id: 3,
        showBody: false,
        title: "What question do you want to ask?",
        description: "",
        options: [{
            answer: "Answer 1",
            canComment: false
        }, {
            answer: "Answer 2",
            canComment: false
        }, {
            answer: "Other",
            canComment: true
        }],
        required: false
    },
    {
        type_id: 4,
        showBody: false,
        title: "What question do you want to ask?",
        description: "",
        options: [{
            answer: "Answer 1",
            canComment: false
        }, {
            answer: "Answer 2",
            canComment: false
        }, {
            answer: "Answer 3",
            canComment: true
        }],
        required: false
    },
    {
        type_id: 5,
        showBody: false,
        title: "What question do you want to ask?",
        description: "",
        required: false
    }, {
        type_id: 6,
        showBody: false,
        title: "What question do you want to ask?",
        description: "",
        required: false
    },
    {
        type_id: 7,
        showBody: false,
        title: "Enter your email",
        description: "",
        required: false
    },
    {
        type_id: 8,
        showBody: false,
        title: "How would you rate us?",
        description: "",
        required: false
    },
    {
        type_id: 9,
        showBody: false,
        title: "Thank you!",
        description: "Your feedback is very important to us.",
        required: false
    }
];
