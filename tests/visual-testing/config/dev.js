
const configMaker = require('./shared/config-maker')
const id = 'backstop_dev'
const referenceDomain = 'https://dev-nnycb.pantheonsite.io'
const testDomain = 'https://ptheon-nnycb.pantheonsite.io'
module.exports = configMaker({ id, referenceDomain, testDomain })