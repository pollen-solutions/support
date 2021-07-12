'use strict'

class AbstractPlugin {
  constructor(el, options = {}) {
    if (this.constructor === AbstractPlugin) {
      throw new TypeError('Abstract class "AbstractPlugin" cannot be instantiated directly');
    }

    this.initialized = false

    this.verbose = false

    this.options = {}

    this.flags = {}

    this.control = {}

    this.el = el
  }

  // Options initialization.
  _initOptions(options) {
    let tagOptions = this.el.dataset.options || {}

    if (tagOptions) {
      try {
        tagOptions = decodeURIComponent(tagOptions)
      } catch (e) {
        console.log(e)
      }
    }

    try {
      tagOptions = JSON.parse(tagOptions)
    } catch (e) {
      console.log(e)
    }

    if (typeof tagOptions === 'object' && tagOptions !== null) {
      Object.assign(this.options, tagOptions)
    }

    Object.assign(this.options, options)
  }

  // Object resolver from dot key
  _objResolver(dotKey, obj) {
    return dotKey.split('.').reduce(function (prev, curr) {
      return prev ? prev[curr] : null
    }, obj || self)
  }

  _init() {
    this.initialized = true
  }

  _destroy() {
    this.initialized = false
  }

  // HELPERS
  // -------------------------------------------------------------------------------------------------------------------
  // Get option value. The syntax of dotted key is allowed.
  option(key = null, defaults = null) {
    if (key === null) {
      return this.options
    }

    return this._objResolver(key, this.options) ?? defaults
  }
}

module.exports = AbstractPlugin;