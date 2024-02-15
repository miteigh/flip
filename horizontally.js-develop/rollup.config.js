import css from "rollup-plugin-import-css";
import { terser } from "rollup-plugin-terser";

export default {
    input: "src/js/horizontally.js",
    output: [
        {
            // Standard file output
            name: "horizontally",
            file: "dist/horizontally.js",
        },
        {
            // Min file output
            name: "horizontally",
            file: "dist/horizontally.min.js",
            format: "umd",
            plugins: [terser()],
        },
    ],
    plugins: [
        css({
            output: "horizontally.css",
            minify: false,
        }),
    ],
};
