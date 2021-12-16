module.exports = {
    "extends": [
        "airbnb-base",
        "plugin:vue/recommended"
    ],
    "plugins": [
        "arca",
        "vue",
    ],
    "env": {
        "es6": true,
        "browser": true,
        "jquery": true,
    },

    "rules": {
        "max-len": [2, {
            "code": 120,
            "tabWidth": 4,
            "comments": 80,
            "ignoreUrls": true
        }],

        "indent": [2, 4],

        "global-require": 0,

        "quotes": [2, "single",{
            "avoidEscape": true,
            "allowTemplateLiterals": true
        }],

        "import/no-unresolved": 0,

        "vue/html-closing-bracket-newline": [2, {
            "singleline": "never",
            "multiline": "never"
        }],

        "vue/html-indent": [2, 4, {
            "attribute": 1,
            "baseIndent": 1,
            "closeBracket": 0,
            "alignAttributesVertically": true,
            "ignores": []
        }],

        "vue/script-indent": [2, 4, {
            "baseIndent": 1
        }],

        "vue/require-prop-types": [0],
        "vue/max-attributes-per-line": [0],

        "arca/import-align": 2,
        "arca/newline-after-import-section": 2,
        "sort-imports": 0,

        "no-multi-spaces": [2, {
            exceptions: {
                "VariableDeclarator": true,
                "ImportDeclaration": true,
            }
        }],
        "object-curly-spacing": [2, "always"],
        "key-spacing": [2, {
            "singleLine": {
                "beforeColon": false,
                "afterColon": true
            },
            "multiLine": {
                "beforeColon": false,
                "afterColon": true,
                "align": "value"
            }
        }],
        "no-undef": [2, {

        }],
    },
    "overrides": [{
        "files": [ "*.js"],
        "rules": {

        }
    }],
    "overrides": [{
        "files": [ "*.vue"],
        "rules": {
            "indent": [0],
        }
    }]
};
