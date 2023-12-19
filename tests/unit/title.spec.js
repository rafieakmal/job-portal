import Vue from 'vue'
import { shallowMount } from '@vue/test-utils'
import Title from '../../resources/js/src/components/voting/Title.vue'

function getRenderedText (Component, propsData) {
  const Constructor = Vue.extend(Component)
  const vm = new Constructor({ propsData: propsData }).$mount()
  return vm.$el.textContent
}

describe('Title.vue', () => {
  it('renders title correctly with different props', () => {
    expect(getRenderedText(Title, {
      title: 'Test Title'
    })).toBe('Test Title')

    expect(getRenderedText(Title, {
      title: 'Test Another Title'
    })).toBe('Test Another Title')

    expect(getRenderedText(Title, {
      title: 'Test Number Title 1'
    })).toBe('Test Number Title 1')
  })
})
