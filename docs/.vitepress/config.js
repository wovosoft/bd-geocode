export default {
    // base: "bkb-offices",
    title: 'Bangladesh Geographical Addresses',
    description: 'Provides Geographical Addresses of Bangladesh',
    themeConfig: {
        siteTitle: 'BD Geographical Addresses',
        nav: [
            {text: 'Configs', link: '/configuration'},
            {text: 'Complements & Complains', link: '/compliments-and-complains'}
        ],
        sidebar: [
            {
                collapsible: true,
                text: 'Basic',
                items: [
                    {text: 'Getting Started', link: '/getting-started'},
                    {text: 'Developer Information', link: '/developer'},
                    {text: 'Configuration', link: '/configuration'},
                ]
            },
            {
                collapsible: true,
                text: 'Digging Deeper',
                items: [
                    {text: 'Theory', link: '/theory'},
                    {text: 'Searching Models', link: '/searching-models'},
                ]
            },
            {
                collapsible: true,
                text: 'Models',
                items: [
                    {text: 'Division', link: '/models/division'},
                    {text: 'District', link: '/models/district'},
                    {text: 'Upazila', link: '/models/upazila'},
                    {text: 'Union', link: '/models/union'},
                ]
            },
            {
                collapsible: true,
                text: 'Traits',
                items: [
                    {text: 'HasDivisionActions', link: '/traits/has-division-actions'},
                    {text: 'HasDistrictActions', link: '/traits/has-district-actions'},
                    {text: 'HasUpazilaActions', link: '/traits/has-upazila-actions'},
                    {text: 'HasUnionAction', link: '/traits/has-union-actions'},
                ]
            }
        ]
    }
}
