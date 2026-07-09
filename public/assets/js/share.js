const btn = document.getElementById("webShare");
const resultPara = document.getElementById("shareAlert");

if (btn) {
  btn.addEventListener("click", () => {
    const shareData = {
      title: btn.dataset.title || "Collection de figurines",
      text: btn.dataset.text || "Retrouvez toute notre collection de figurines",
      url: btn.dataset.url || window.location.href,
    };

    navigator
      .share(shareData)
      .then(() => {
        resultPara.textContent = "Le partage a réussi";
      })
      .catch((e) => {
        resultPara.textContent = "Erreur : " + e;
      });
  });
}
