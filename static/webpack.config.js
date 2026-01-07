const path = require("path");
const webpack = require("webpack");
const TerserPlugin = require("terser-webpack-plugin");
const CopyWebpackPlugin = require("copy-webpack-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

const config = {
  entry: [
    "./src/scss/index.scss",
    "./src/scss/print.scss",
    "./src/js/index.ts",
  ],
  output: {
    filename: "js/index.js",
    path: path.resolve(__dirname, "build"),
    publicPath: "../",
    clean: true,
  },
  resolve: {
    extensions: [".js", ".json", ".ts", ".hbs", ".mjs"],
    alias: {
      "@universityofmaryland/web-styles-library": path.resolve(
        __dirname,
        "node_modules/@universityofmaryland/web-styles-library/dist"
      ),
    },
  },
  optimization: {
    minimizer: [
      new TerserPlugin({
        parallel: true,
      }),
      new CssMinimizerPlugin(),
    ],
  },
  module: {
    rules: [
      {
        test: /\.tsx?$/,
        loader: "ts-loader",
        exclude: /node_modules/,
        options: {
          transpileOnly: true,
        },
      },
      {
        test: /\.m?js$/,
        exclude: /node_modules\/(?!@universityofmaryland)/,
        resolve: {
          fullySpecified: false,
        },
        use: {
          loader: "babel-loader",
          options: {
            presets: [
              [
                "@babel/preset-env",
                {
                  targets: {
                    chrome: "80",
                    firefox: "74",
                    safari: "13.1",
                    edge: "80",
                  },
                  modules: false,
                },
              ],
            ],
            plugins: [
              "@babel/plugin-transform-optional-chaining",
              "@babel/plugin-transform-nullish-coalescing-operator",
              "@babel/plugin-proposal-export-namespace-from",
            ],
          },
        },
      },
      {
        test: /\.scss$/,
        oneOf: [
          {
            exclude: [path.resolve(__dirname, "src/scss/print.scss")],
            use: [
              MiniCssExtractPlugin.loader,
              "css-loader",
              {
                loader: "postcss-loader",
                options: {
                  postcssOptions: {
                    plugins: [["autoprefixer"]],
                  },
                },
              },
              "resolve-url-loader",
              {
                loader: "sass-loader",
                options: {
                  sourceMap: true,
                  implementation: require("sass"),
                  sassOptions: {
                    quietDeps: true, // Suppress warnings from dependencies
                    warnForDeprecation: false, // Suppress deprecation warnings during transition
                  },
                },
              },
            ],
          },
          {
            include: [path.resolve(__dirname, "src/scss/print.scss")],
            use: [
              {
                loader: MiniCssExtractPlugin.loader,
                options: {
                  publicPath: "../",
                },
              },
              "css-loader",
              {
                loader: "postcss-loader",
                options: {
                  postcssOptions: {
                    plugins: [["autoprefixer"]],
                  },
                },
              },
              "resolve-url-loader",
              {
                loader: "sass-loader",
                options: {
                  sourceMap: true,
                  implementation: require("sass"),
                  sassOptions: {
                    quietDeps: true, // Suppress warnings from dependencies
                    warnForDeprecation: false, // Suppress deprecation warnings during transition
                  },
                },
              },
            ],
          },
        ],
      },
      {
        test: /\.(woff|woff2|eot|ttf)$/,
        type: "asset/resource",
        generator: {
          filename: "fonts/[name][ext]",
        },
        exclude: [path.resolve(__dirname, "img")],
      },
      {
        test: /\.svg$/,
        type: "asset/resource",
        generator: {
          filename: "fonts/[name][ext]",
        },
        exclude: [path.resolve(__dirname, "src", "img")],
      },
      {
        test: /\.(jpg|jpeg|gif|png)$/,
        type: "asset",
        parser: {
          dataUrlCondition: {
            maxSize: 1000,
          },
        },
        generator: {
          filename: "img/[name][ext]",
        },
        exclude: [path.resolve(__dirname, "fonts")],
      },
      {
        test: /\.svg$/,
        type: "asset/resource",
        generator: {
          filename: "img/[name][ext]",
        },
        exclude: [path.resolve(__dirname, "src", "fonts")],
      },
      {
        test: /\.(hbs|handlebars)$/,
        loader: "handlebars-loader",
      },
      {
        test: /\.html$/,
        loader: "html-loader",
      },
    ],
  },
  plugins: [
    new CopyWebpackPlugin({
      patterns: [
        {
          from: "src/img",
          to: "img",
        },
        {
          from: "src/video",
          to: "video",
        },
      ],
    }),

    new MiniCssExtractPlugin({
      filename: "css/index.css",
    }),
  ],
};

module.exports = (env, argv) => {
  if (argv.mode === "development") {
    config.devServer = {
      hot: true,
      devMiddleware: {
        publicPath: "/build/",
      },
    };
    config.plugins.push(new webpack.HotModuleReplacementPlugin());
  }

  config.plugins.push(
    new webpack.DefinePlugin({
      "process.env": JSON.stringify(argv),
    })
  );

  return config;
};
