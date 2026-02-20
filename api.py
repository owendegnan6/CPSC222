from flask import Flask, request, jsonify
import pwd
import grp

app = Flask(__name__)

USERNAME = "test"
PASSWORD = "abcABC123"

def check_auth(data):
 if not data:
   return False
 return data.get("username") == USERNAME and data.get("password") == PASSWORD

@app.route("/api/users", methods=["POST"])
def users():
  data = request.get_json()
  if not check_auth(data):
    return jsonify({"error": "Unauthorized"}), 401

  users_dict = {u.pw_uid: u.pw_name for u in pwd.getpwall()}
  return jsonify(users_dict)

@app.route("/api/groups", methods=["POST"])
def groups():
  data = request.get_json()
  if not check_auth(data):
    return jsonify({"error": "Unauthorized"}), 401

  groups_dict = {g.gr_gid: g.gr_name for g in grp.getgrall()}
  return jsonify(groups_dict)

if __name__ == "__main__":
  app.run(host="0.0.0.0" , port=3000)
