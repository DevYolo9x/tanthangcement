module.exports = {
    mode: "jit",
    purge: ["./*.html", "./resources/**/*.blade.php", './resources/**/*.js'],
    darkMode: "class", // or 'media' or 'class'
    content: [
        'node_modules/preline/dist/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                'Roboto_Helvetica': ['"Roboto"', "Helvetica", "Arial", "sans-serif"],
            },
            spacing: {
                35: "35px",
            },
            height: {
                '22px': '22px',
                '36px': '36px',
                '55px': '55px',
                '175px': '175px',
                '260px': '260px',
                '280px': '280px',
                '310px': '310px',
                '315px': '315px',
                '300px': '300px',
                '320px': '320px',
                '350px': '350px',
                '500px': '500px'
            },
            backgroundImage: {
                custom_gradient: 'linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(64,41,21,1) 100%, rgba(0,212,255,1) 100%)',
                body_gradient: 'linear-gradient(270deg, #000000 0%, #1615AF 100%)',
                footer_gradient: 'linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(64, 41, 21, 1) 100%, rgba(0, 212, 255, 1) 100%)',
            },
            colors: {
                color_primary: "#4288c3",
                color_second: "#b1061e",
                color_top: "#00ff45",
                color_fourth: "#3a3b3a",
                color_five: "#2f6d62",
                color_hover: "#0000005c",
                color_document: "#8b0025",
                text_hover: "#edc630",
                color_breadcrumb: "#F5F5F5",
            },
            boxShadow: {
                'dark': '0 1px 2px 0 rgba(255, 255, 255, 0.05)', //White shadow
            },
            fontSize: {
                f10: ['10px'],
                f11: ['11px'],
                f12: ['12px', '14px'],
                f13: ['13px'],
                f14: ['14px'],
                f15: ['15px', '20px'],
                f16: ['16px'],
                f17: ['17px'],
                f18: ['18px', '20px'],
                f19: ['19px'],
                f20: ['20px', '24px'],
                f21: ['21px'],
                f22: ['22px'],
                f23: ['23px'],
                f24: ['24px', '28px'],
                f25: ['25px', '28px'],
                f26: ['26px'],
                f27: ['27px'],
                f28: ['28px', '40px'],
                f29: ['29px'],
                f30: ['30px', '32px'],
                f31: ['31px'],
                f32: ['32px', '36px'],
                f33: ['33px'],
                f34: ['34px'],
                f35: ['35px'],
                f36: ['36px'],
                f37: ['37px'],
                f38: ['38px'],
                f39: ['39px'],
                f40: ['40px'],

                f41: ['41px'],
                f48: ['48px'],
                f50: ['50px'],
                f54: ['54px', '60px'],
            },
            spacing: {
                '0px': '0px',
                '1px': '1px',
                '2px': '2px',
                '2.5px': '2.5px',
                '3px': '3px',
                '4px': '4px',
                '5px': '5px',
                '6px': '6px',
                '7px': '7px',
                '8px': '8px',
                '9px': '9px',
                '10px': '10px',
                '11px': '11px',
                '12px': '12px',
                '13px': '13px',
                '14px': '14px',
                '15px': '15px',
                '16px': '16px',
                '17px': '17px',
                '18px': '18px',
                '19px': '19px',
                '20px': '20px',
                '21px': '21px',
                '22px': '22px',
                '23px': '23px',
                '24px': '24px',
                '25px': '25px',
                '26px': '26px',
                '27px': '27px',
                '28px': '28px',
                '29px': '29px',
                '30px': '30px',
                '32px': '32px',
                '36px': '36px',
                '47px': '47px',
                '49px': '49px',
                '50px': '50px',
                '54px': '54px',
                '60px': '60px',
                '75px': '75px',
                '78px': '78px',
                '100px': '100px',
                '130px': '130px',
                '500px': '500px',

            },
            translate: {
                '50': '50%',

            },
        },
    },
    variants: {
        extend: {
            backgroundColor: ["odd"],
            fill: ['hover', 'focus'], // this line does the trick
        },
    },
    plugins: [
        function ({ addComponents }) {
            addComponents({
                ".container": {
                    width: "100%",
                    "@screen sm": {
                        maxWidth: "640px",
                    },
                    "@screen md": {
                        maxWidth: "768px",
                    },
                    "@screen lg": {
                        maxWidth: "1025px",
                    },
                    "@screen xl": {
                        maxWidth: "1200px",
                    },
                },
            });
        },
        require('preline/plugin'),

        // config modal
    ],
    ins: [
        function ({ addComponents }) {
            addComponents({
                ".container": {
                    width: "100%",
                    "@screen sm": {
                        maxWidth: "640px",
                    },
                    "@screen md": {
                        maxWidth: "768px",
                    },
                    "@screen lg": {
                        maxWidth: "1025px",
                    },
                    "@screen xl": {
                        maxWidth: "1300px",
                    },
                },
            });
        },
    ],
};