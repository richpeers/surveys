export {AvailableQuestions, SurveyQuestions};

let SurveyQuestions = [
    {
        type: "Multiple line text",
        type_id: 6,
        showBody: false,
        title: "What question do you want to ask?",
        description: "",
        required: 0,
        icon: 'fa-play'
    },
    {
        type: "Success page",
        type_id: 9,
        showBody: false,
        title: "Thank you!",
        description: "Your feedback is very important to us.",
        required: 0,
        icon: 'fa-play'
    }
];

let AvailableQuestions = [
    {
        type: "Welcome page",
        type_id: 1,
        showBody: false,
        title: "Tell us what you think!",
        description: "Please take a moment to fill out this short survey to let us know how we did and where we can improve.",
        titleLabel: "Title",
        buttonText: "Start Survey",
        required: 0,
        icon: 'fa-sun-o'
    },
    {
        type: "Radio buttons",
        type_id: 2,
        showBody: false,
        title: "What question do you want to ask?",
        description: "",
        options: [{
            answer: "Answer 1",
            canComment: 0
        }, {
            answer: "Answer 2",
            canComment: 0
        }, {
            answer: "Other",
            canComment: 1
        }],
        required: 0,
        icon: 'fa-dot-circle-o'
    },
    {
        type: "Checkboxes",
        type_id: 3,
        showBody: false,
        title: "What question do you want to ask?",
        description: "",
        options: [{
            answer: "Answer 1",
            canComment: 0
        }, {
            answer: "Answer 2",
            canComment: 0
        }, {
            answer: "Other",
            canComment: 1
        }],
        required: 0,
        icon: 'fa-check-square-o'
    },
    {
        type: "Dropdown list",
        type_id: 4,
        showBody: false,
        title: "What question do you want to ask?",
        description: "",
        options: [{
            answer: "Answer 1",
            canComment: 0
        }, {
            answer: "Answer 2",
            canComment: 0
        }, {
            answer: "Answer 3",
            canComment: 0
        }],
        required: 0,
        icon: 'fa-caret-down'
    },
    {
        type: "Single line text",
        type_id: 5,
        showBody: false,
        title: "What question do you want to ask?",
        description: "",
        required: 0,
        icon: 'fa-font'
    }, {
        type: "Multiple line text",
        type_id: 6,
        showBody: false,
        title: "What question do you want to ask?",
        description: "",
        required: 0,
        icon: 'fa-pencil-square-o'
    },
    {
        type: "Email address",
        type_id: 7,
        showBody: false,
        title: "Enter your email",
        description: "",
        required: 1,
        icon: 'fa-at'
    },
    {
        type: "Rating",
        type_id: 8,
        showBody: false,
        title: "How would you rate us?",
        description: "",
        required: 1,
        icon: 'fa-star-half-o'
    },
    {
        type: "Success page",
        type_id: 9,
        showBody: false,
        title: "Thank you!",
        description: "Your feedback is very important to us.",
        required: 0,
        icon: 'fa-check'
    }
];
