
const configMaker = require('./shared/config-maker')
const id = 'backstop_test'
const referenceDomain = 'https://ptheon-nnycb.pantheonsite.io'
const testDomain = 'http://appserver.nnycb.internal'
module.exports = configMaker({ id, referenceDomain, testDomain })