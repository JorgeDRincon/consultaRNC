import { mount } from '@vue/test-utils'
import { beforeEach, describe, expect, it } from 'vitest'
import Welcome from './Welcome.vue'

describe('Welcome Page - Navigation Buttons', () => {
    let wrapper

    beforeEach(() => {
        wrapper = mount(Welcome, {
            global: {
                stubs: {
                    // Stub para el componente Head que renderiza un div con data-testid
                    Head: {
                        template: '<div data-testid="head"></div>',
                        props: ['title']
                    },
                    // Stub para el componente Navigation que renderiza un nav con data-testid
                    Navigation: {
                        template:
                            '<nav data-testid="navigation">Navigation</nav>'
                    },
                    // Stub para el componente Footer que renderiza un footer con data-testid
                    Footer: {
                        template:
                            '<footer data-testid="footer">Footer</footer>'
                    },
                    // Stub para el componente Link que renderiza un enlace con href y slot
                    Link: {
                        template: '<a :href="href"><slot /></a>',
                        props: ['href']
                    }
                }
            }
        })
    })

    it('renders the documentation button with correct href', () => {
        const docButton = wrapper.find('a[href="/documentation"]')
        expect(docButton.text()).toBe('Ver Documentación')
    })

    it('renders the about button with correct href', () => {
        const aboutButton = wrapper.find('a[href="/documentation/about"]')
        expect(aboutButton.text()).toBe('Conocer Más')
    })
})
