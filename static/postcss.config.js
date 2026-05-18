module.exports = {
  plugins: {
    autoprefixer: {},
    "postcss-pxtorem": {
      rootValue: 16,
      propList: ["*"],
    },
    "postcss-extend-rule": {},
    "postcss-preset-env": {
      stage: 2,
      browsers: [
        "> 0.5%",
        "last 2 versions",
        "Firefox ESR",
        "not dead",
        "not op_mini all",
      ],
    },
  },
};
