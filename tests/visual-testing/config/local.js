
const configMaker = require('./shared/config-maker')
const id = 'backstop_local'
const referenceDomain = 'https://dev-nnycb.pantheonsite.io'
const testDomain = 'http://appserver.nnycb.internal'
module.exports = configMaker({ id, referenceDomain, testDomain })