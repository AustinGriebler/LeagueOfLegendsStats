export default {
  updateSummoner (name) {
    axios.post(`proxy.php`, {
      action: 'updateSummoner',
      name: name
    })
      // () => {}
      // function () {}
      .then((data) => {
        console.log(data)
      })
  }
}
