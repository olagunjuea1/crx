const ifsc = require('../../src/node');
const assert = require('assert');

const expected = require('../fixture/HDFC0CAGSBK')

// The nodejs tests do not mock the connect call, so this might break after a new release.
ifsc
  .fetchDetails('KKBK0000261')
  .then(function(res) {
    assert.equal('JMD REGENT SQUARE,MEHRAULI GURGAON ROAD,OPPOSITE BRISTOL HOTEL,',res['ADDRESS'])
    assert.equal('Kotak Mahindra Bank',res['BANK'])
    assert.equal('KKBK',res['BANKCODE'])
    assert.equal('GURGAON',res['BRANCH'])
    assert.equal('GURGAON',res['CENTRE'])
    assert.equal('GURGAON',res['CITY'])
    assert.equal('GURGAON',res['DISTRICT'])
    assert.equal('KKBK0000261',res['IFSC'])
    assert.equal('110485003',res['MICR'])
    assert.equal('HARYANA',res['STATE'])
    assert.equal('110485003',res['MICR'])
    assert.equal(true,res['UPI'])
    assert.equal(true,res['NEFT'])
    assert.equal(true,res['IMPS'])
    assert.equal(true,res['RTGS'])
    assert.equal("",res['SWIFT'])
  })
  .catch(err => {
    console.error(err);
    process.exit(1);
  })

ifsc.fetchDetails('HDFC0CAGSBK')
  .then(function(res) {
    assert.deepEqual(expected, res)
  })
  .catch(err => {
    console.error(err);
    process.exit(1);
  })
