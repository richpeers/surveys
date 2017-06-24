const QuestionTypeParams = {
    1: {
        type: "Welcome page",
        titleLabel: "Title",
        canBeRequired: false,
        icon: "fa-handshake-o",
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
export default QuestionTypeParams;
