#!/bin/sh
openssl req -new -x509 -key tls.key -out tls.crt -subj /C=CN/ST=Beijing/L=Beijing/O=DevOps/CN=tomcat.along.com
kubectl create secret tls tomcat-ingress-secret --cert=tls.crt --key=tls.key
kubectl create secret tls k7s-dashboard-secret --cert=tls.crt --key=tls.key
systemctl daemon-reload
systemctl show --property=Environment docker
systemctl restart docker

