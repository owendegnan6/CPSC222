from flask import Flask

app = Flask(__name__)

@app.route("/api/<path:subpath>")
def api(subpath):
  return f"API working! You accessed /api{subpath}"

if __name__ == "__main__":
  app.run(host="0.0.0.0", port=5000)

