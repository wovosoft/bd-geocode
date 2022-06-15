export default {
    // base: "bkb-offices",
    title: 'BKB Office Provider',
    description: 'Provides List of Offices, Office Types of Laravel Related Projects of Bangladesh Krishi Bank',
    themeConfig: {
        siteTitle: 'BKB Office Provider',
        nav: [
            {text: 'Overview', link: '/why-separate-package'},
            {text: 'Configs', link: '/configuration'},
            {text: 'Complements & Complains', link: '/compliments-and-complains'}
        ],
        sidebar: [
            {
                collapsible: true,
                text: 'Basic',
                items: [
                    {text: 'Getting Started', link: '/getting-started'},
                    {text: 'Why Separate Package', link: '/why-separate-package'},
                    {text: 'Developer Information', link: '/developer'},
                    {text: 'Configuration', link: '/configuration'},
                ]
            },
            {
                collapsible: true,
                text: 'Digging Deeper',
                items: [
                    {text: 'Theory', link: '/theory'},
                    {text: 'Office Types', link: '/office-types'},
                    {text: 'Searching Models', link: '/searching-models'},
                ]
            },
            {
                collapsible: true,
                text: 'Discussion on Models',
                items: [
                    {text: 'Office', link: '/models/office'},
                    {text: 'Office Type', link: '/models/office-type'},
                    {text: 'Branch', link: '/models/branch'},
                    {text: 'CRM/RM Office', link: '/models/crm-rm-office'},
                    {text: 'Divisional Office', link: '/models/divisional-office'},
                    {text: 'Divisional Audit Office', link: '/models/divisional-audit-office'},
                    {text: 'Regional Audit Office', link: '/models/regional-audit-office'},
                    {text: 'Head Office', link: '/models/head-office'},
                    {text: 'Corporate Branch', link: '/models/corporate-branch'},
                ]
            }
        ]
    }
}
