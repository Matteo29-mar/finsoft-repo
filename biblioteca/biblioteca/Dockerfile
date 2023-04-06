# define base docker image
FROM openjdk:17
LABEL maintainer="springbiblio"
ADD target/biblioteca-0.0.1-SNAPSHOT.jar biblioteca.jar
ENTRYPOINT ["java", "-jar", "biblioteca.jar"]