import { mount } from '@vue/test-utils'
import { beforeEach, describe, expect, it } from 'vitest'
import Welcome from './Welcome.vue'

describe('Welcome Page - Navigation Buttons', () => {
    let wrapper

    beforeEach(() => {
        wrapper = mount(Welcome, {
            global: {
                stubs: {
                    Head: true,
                    Navigation: true,
                    Footer: true,
                    Link: true
                }
            }
        })
    })

    it('renders the Welcome component', () => {
        expect(wrapper.exists()).toBe(true)
    })

    it('contains documentation text', () => {
        expect(wrapper.text()).toContain('Ver Documentación')
    })
})
