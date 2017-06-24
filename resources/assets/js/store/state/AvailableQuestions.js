const AvailableQuestions = [
    {
        order: 0,
        type_id: 1,
        showBody: false,
        title: "Tell us what you think!",
        description: "Please take a moment to fill out this short survey to let us know how we did and where we can improve.",
        required: false,
        comment_placeholder: ""
    },
    {
        order: 0,
        type_id: 2,
        showBody: false,
        title: "What question do you want to ask?",
        description: "",
        options: [{
            order: 1,
            answer: "Answer 1",
            canComment: false,
        }, {
            order: 2,
            answer: "Answer 2",
            canComment: false,
        }, {
            order: 3,
            answer: "Other",
            canComment: true,
        }],
        required: false,
        comment_placeholder: 'Please specify (optional)'
    },
    {
        order: 0,
        type_id: 3,
        showBody: false,
        title: "What question do you want to ask?",
        description: "",
        options: [{
            order: 1,
            answer: "Answer 1",
            canComment: false,
        }, {
            order: 2,
            answer: "Answer 2",
            canComment: false,
        }, {
            order: 3,
            answer: "Other",
            canComment: true,
        }],
        required: false,
        comment_placeholder: 'Please specify (optional)'
    },
    {
        order: 0,
        type_id: 4,
        showBody: false,
        title: "What question do you want to ask?",
        description: "",
        options: [{
            order: 1,
            answer: "Answer 1",
            canComment: false,
        }, {
            order: 2,
            answer: "Answer 2",
            canComment: false,
        }, {
            order: 3,
            answer: "Answer 3",
            canComment: true,
        }],
        required: false,
        comment_placeholder: 'Please specify (optional)'
    },
    {
        order: 0,
        type_id: 5,
        showBody: false,
        title: "What question do you want to ask?",
        description: "",
        required: false,
        comment_placeholder: ""
    },
    {
        order: 0,
        type_id: 6,
        showBody: false,
        title: "What question do you want to ask?",
        description: "",
        required: false,
        comment_placeholder: ""
    },
    {
        order: 0,
        type_id: 7,
        showBody: false,
        title: "Enter your email",
        description: "",
        required: false,
        comment_placeholder: ""
    },
    {
        order: 0,
        type_id: 8,
        showBody: false,
        title: "How would you rate us?",
        description: "",
        required: false,
        comment_placeholder: ""
    },
    {
        order: 0,
        type_id: 9,
        showBody: false,
        title: "Thank you!",
        description: "Your feedback is very important to us.",
        required: false,
        comment_placeholder: ""
    }
];
export default AvailableQuestions;
