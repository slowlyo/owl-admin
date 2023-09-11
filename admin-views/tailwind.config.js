module.exports = {
    content    : [
        './src/pages/**/*.tsx',
        './src/components/**/*.tsx',
        './src/layouts/**/*.tsx',
    ],
    theme      : {
        extend: {
            borderRadius: {
                DEFAULT: '4px',
            }
        },
    },
    plugins    : [],
    corePlugins: {
        preflight: false,
    }
}